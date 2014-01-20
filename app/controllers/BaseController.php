<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function unexpectedError($message, $to = 'back')
	{
		if ($to == 'back')
			return Redirect::back()->withMessage($message)->withType('danger');
		return Redirect::to($to)->withMessage($message)->withType('danger');
	}

}