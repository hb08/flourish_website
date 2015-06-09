<?php

class OverviewController extends BaseController {

	public function getTotals()
	{
		/* Get totals for plant (ALL FOR NOW) */
		 
		return View::make('overview');
	}
} /* Ends Controller Class */
