<?php

/**
 * IMAP controller.
 *
 * @category   apps
 * @package    imap
 * @subpackage controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2012 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/imap/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * IMAP controller.
 *
 * @category   apps
 * @package    imap
 * @subpackage controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2012 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/imap/
 */

class IMAP extends ClearOS_Controller
{
    /**
     * IMAP summary view.
     *
     * @return view
     */

    function index()
    {
        // Show Certificate Manager widget if it is not initialized
        //---------------------------------------------------------

        $this->load->module('certificate_manager/certificate_status');

        if (! $this->certificate_status->is_initialized()) {
            $this->certificate_status->widget();
            return;
        }

        // Load libraries
        //---------------

        $this->lang->load('imap');

        // Load views
        //-----------

        $views = array('imap/server', 'imap/settings', 'imap/policy');

        $this->page->view_forms($views, lang('imap_app_name'));
    }
}
