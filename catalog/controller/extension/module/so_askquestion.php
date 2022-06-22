<?php

class ControllerExtensionModuleSoAskQuestion extends Controller {
	public function index() {
		$data       = array();
        $this->load->language('extension/module/so_askquestion');

        if (isset($this->request->get['product_id'])) {
            $data['product_id'] = (int)$this->request->get['product_id'];
        } else {
            $data['product_id'] = 0;
        }

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $data['base'] = $this->config->get('config_ssl');
        } else {
            $data['base'] = $this->config->get('config_url');
        }

        $data['status'] = $this->config->get('module_so_askquestion_status');
        $data['show_name'] = $this->config->get('module_so_askquestion_show_name');
        $data['require_name'] = $this->config->get('module_so_askquestion_require_name');
        $data['show_phone'] = $this->config->get('module_so_askquestion_show_phone');
        $data['require_phone'] = $this->config->get('module_so_askquestion_require_phone');
        $data['show_question'] = $this->config->get('module_so_askquestion_show_question');
        $data['require_question'] = $this->config->get('module_so_askquestion_require_question');

        $this->response->setOutput($this->load->view('extension/module/so_askquestion', $data));
	}

    function sendData() {
        $this->load->language('extension/module/so_askquestion');

        $json = array();
        if (isset($this->request->post['isAjax']) && $this->request->post['isAjax'] == 1 && isset($this->request->post['product_id'])) {
            if ($this->config->get('module_so_askquestion_require_name')) {
                if (isset($this->request->post['name']) && $this->config->get('module_so_askquestion_show_name')) {
                    if (!isset($this->request->post['name']) || trim($this->request->post['name']) == '') {
                        $json['errors'][] = array('code'=>701, 'error'=>$this->language->get('error_name'));
                    }
                }
            }

            if (!isset($this->request->post['email']) || trim($this->request->post['email']) == '' || (!filter_var(trim($this->request->post['email']), FILTER_VALIDATE_EMAIL))) {
                $json['errors'][] = array('code'=>702, 'error'=>$this->language->get('error_email'));
            }

            if ($this->config->get('module_so_askquestion_require_phone')) {
                if (isset($this->request->post['phone']) && $this->config->get('module_so_askquestion_show_phone')) {
                    if (!isset($this->request->post['phone']) || trim($this->request->post['phone']) == '') {
                        $json['errors'][] = array('code'=>703, 'error'=>$this->language->get('error_number'));
                    }
                }
            }

            if ($this->config->get('module_so_askquestion_require_question')) {
                if (isset($this->request->post['message']) && $this->config->get('module_so_askquestion_show_question')) {
                    if (!isset($this->request->post['message']) || trim($this->request->post['message']) == '') {
                        $json['errors'][] = array('code'=>705, 'error'=>$this->language->get('error_message'));
                    }
                }
            }

            if (!$json) {
                $this->load->model('extension/module/so_askquestion');

                if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
                    $base = $this->config->get('config_ssl');
                } else {
                    $base = $this->config->get('config_url');
                }

                $data = array(
                    'product_id'    => (int)$this->request->post['product_id'],
                    'product_link'  => $this->url->link('product/product', 'product_id=' . (int)$this->request->post['product_id']),
                    'shop_url'      => $base,
                    'name'          => isset($this->request->post['name']) ? trim($this->request->post['name']) : '',
                    'email'         => trim($this->request->post['email']),
                    'phone'         => isset($this->request->post['phone']) ? trim($this->request->post['phone']) : '',
                    'message'       => isset($this->request->post['message']) ? trim($this->request->post['message']) : ''
                );

                $this->model_extension_module_so_askquestion->sendData($data);
                $json['status'] = 1;
                $json['success'] = $this->language->get('text_success');
            }
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}