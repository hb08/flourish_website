<?php
class PlotController extends BaseController {
/* Opening Page  */
	public function startPlotter()
	{
		$uid = 9; /* Change with User Specific Interaction */
		$userList = DB::table('user_lists')->where('user_id', $uid)->get();
		$count = count($userList);
		return View::make('pages.plot_begin', array('title' => 'Garden Plotter | Flourish – Your Florida Gardening Guide', 'count' => $count, 'userList' => $userList));
	}

/* New Plot */
	public function newPlot()
	{
		$input = Input::all();
		return View::make('pages.plot_new', array('title' => 'New Garden | Flourish – Your Florida Gardening Guide', 'input' => $input));
	}
}
