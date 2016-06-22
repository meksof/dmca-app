<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PrepareNoticeRequest;
use App\Notice;
use App\Provider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NoticesController extends Controller
{
	/**
	 * Create a new instance controller
	 */
	function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Show all notices
	 */
	public function index()
	{
		$notices = Auth::user()->notices();

		return view('notices.show', compact('notices'));
	}
	/**
	 * 
	 */
	public function create()
	{
		// get list of providers
		$providers = Provider::lists('name', 'id');
		// load a view to create a new notice
		return view('notices.create', compact('providers'));	
	}
	/**
	 * Ask the user to confirm data
	 *
	 * @return void
	 * 
	 **/
	public function confirm(Requests\PrepareNoticeRequest $request, Guard $auth)
	{	
		$template = $this->compileDmcaTemplate($data = $request->all(), $auth);
		session()->flash('dmca', $data);
		return view('notices.confirm', compact('template'));
	}
	/**
	 * Store notice
	 *
	 * @return void
	 * 
	 **/
	public function store(Request $request)
	{
		$notice = $this->createNotice($request);
		
		// fire off the email
		Mail::queue('emails.dmca', compact('notice'), function($message) use ($notice){
				$message->from($notice->getOwnerEmail())
					->to($notice->getRecipientEmail())
					->subject('DMCA notice'); 
		});
		
		return redirect('notices');

	}

	/**
	 * Prepare and compile the dmca Template from the form data
	 *
	 * @return array
	 * 
	 **/
	public function compileDmcaTemplate($data, Guard $auth)
	{
		$data = $data + [
			'name' => $auth->user()->name,
			'email' => $auth->user()->email,
		];
		$template = view()->file( app_path('Http/Templates/dmca.blade.php'), $data );
		return $template;
	}


	/**
	 * Create and persist a new DMCA notice.
	 *
	 * @param Request $request
	 */
	public function createNotice(Request $request)
	{
		$data = session()->get('dmca');

		$notice = Notice::open($data)
			->useTemplate($request->input('template'));
		
		$notice = Auth::user()->notices()->save($notice);

		return $notice;
	}

	/**
	 * Remove a notice
	 */
	public function removeNotice(Request $request, $id = null)
	{
		Notice::where('id', $id)->update(['content_removed' => 1]);
		dd('>>> Notice with id ' . $id . ' was removed');
	}
}
