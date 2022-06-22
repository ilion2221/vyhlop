<?php

class ModelExtensionModuleSoAskQuestion extends Model {

	public function sendData($data) {
		$this->load->language('extension/module/so_askquestion');
		$this->load->model('catalog/product');
		
		$product_info = $this->model_catalog_product->getProduct($data['product_id']);
		
		$mail = new Mail($this->config->get('config_mail_engine'));
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$subject = sprintf($this->language->get('text_subject'), html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8'));
		
		$message = "Hello, ".html_entity_decode($data['name'], ENT_QUOTES, 'UTF-8');
		$message .= "\n";
		$message .= "Thank you for your interest in our ".html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')." ".html_entity_decode($data['product_link'], ENT_QUOTES, 'UTF-8');
		$message .= "\n";
		$message .= "Your request has been forwarded to the concerned department and we will be in touch with you shorly";
		$message .= "\n\n\n";
		$message .= "Your information:";
		$message .= "\n";
		if ($data['name'] != '') {
			$message .= "Your Name: ".$data['name'];
			$message .= "\n";
		}
		$message .= "Your Email: ".$data['email'];
		$message .= "\n";
		if ($data['phone'] != '') {
			$message .= "Contact Number: ".$data['phone'];
			$message .= "\n";
		}
		if ($data['message'] != '') {
			$message .= "Question: ".$data['message'];
			$message .= "\n\n\n";
		}
		$message .= "Best Regards";
		$message .= "\n";
		$message .= $this->config->get('config_name');
		$message .= "\n";
		$message .= $data['shop_url'];

		$mail->setTo($this->config->get('config_email'));
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();

		if ($this->config->get('module_so_askquestion_add_email')) {
			$emails = explode(',', $this->config->get('module_so_askquestion_add_email'));
			foreach ($emails as $email) {
				if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) && trim($email) != $this->config->get('config_email')) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

		if ($data['email'] && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$mail->setTo($data['email']);
			$mail->send();
		}
	}
}