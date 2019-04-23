<?php
$code = $this->input->post('captcha');
			$code2 = strtolower($this->session->userdata('code'));
			if(strtolower($code) != $code2){
				echo "<script>alert('Verification Code Error, Please Re-enter');window.location='./register'</script>";
			}else{