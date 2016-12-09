<?php

/**
 * IMAP controller.
 *
 * @category   apps
 * @package    imap
 * @subpackage controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
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
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

use \clearos\apps\imap\Cyrus as Cyrus;

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * IMAP settings controller.
 *
 * @category   apps
 * @package    imap
 * @subpackage controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/imap/
 */

class Settings extends ClearOS_Controller
{
    /**
     * IMAP settings default controller.
     *
     * @return view
     */

    function index()
    {
        $this->_common('view');
    }

    /**
     * Edit view
     *
     * @return view
     */

    function edit()
    {
        $this->_common('edit');
    }

    /**
     * View view
     *
     * @return view
     */

    function view()
    {
        $this->_common('view');
    }

    /**
     * Common form.
     *
     * @param string $form_type form type
     *
     * @return view
     */

    function _common($form_type)
    {
        // Load libraries
        //---------------

        $this->load->library('imap/Cyrus');
        $this->lang->load('imap');

        // Handle form submit
        //-------------------

        if ($this->input->post('submit')) {
            try {
                $this->cyrus->set_service_state(Cyrus::SERVICE_POP3, $this->input->post('pop3'));
                $this->cyrus->set_service_state(Cyrus::SERVICE_POP3S, $this->input->post('pop3s'));
                $this->cyrus->set_service_state(Cyrus::SERVICE_IMAP, $this->input->post('imap'));
                $this->cyrus->set_service_state(Cyrus::SERVICE_IMAPS, $this->input->post('imaps'));
                $this->cyrus->set_idled_state($this->input->post('idled'));
                // $this->cyrus->set_ssl_certificate($this->input->post('ssl_certificate'));

                $this->cyrus->reset(TRUE);

                $this->page->set_status_updated();
            } catch (Exception $e) {
                $this->page->view_exception($e);
                return;
            }
        }

        // Load view data
        //---------------

        try {
            $data['form_type'] = $form_type;
            $data['pop3'] = $this->cyrus->get_service_state(Cyrus::SERVICE_POP3);
            $data['pop3s'] = $this->cyrus->get_service_state(Cyrus::SERVICE_POP3S);
            $data['imap'] = $this->cyrus->get_service_state(Cyrus::SERVICE_IMAP);
            $data['imaps'] = $this->cyrus->get_service_state(Cyrus::SERVICE_IMAPS);
            $data['idled'] = $this->cyrus->get_idled_state();
            // $data['certificate'] = $this->cyrus->get_certificate();
            // $data['certificate_options'] = $this->cyrus->get_certificate_options();
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $this->page->view_form('imap', $data);
    }
}
