<?php

    namespace Drupal\custom_form\Form;
	
    use Drupal\Core\Form\FormBase;
    use Drupal\Core\Form\FormStateInterface;
    use Drupal\Core\Database\Database;
    /**
     * Class customForm for demostration.
    */
    class customForm extends FormBase {
      
	  /**
       * {@inheritdoc}
      */
      public function getFormId() {
        return 'custom_form';
      }
	  
      /**
       * {@inheritdoc}
      */
      public function buildForm(array $form, FormStateInterface $form_state) {

		$form['name'] = array(
			'#type' => 'textfield',
			'#title' => t('Name:'),
			'#required' => TRUE,
		);
		
		$form['email'] = array(
			'#type' => 'email',
			'#title' => t('Email ID:'),
			'#required' => TRUE,
		);
		
		$form['phone'] = array (
			'#type' => 'tel',
			'#title' => t('Mobile no'),
		);
		
        $form['website_url'] = array(
			'#type' => 'url',
			'#title' => t('Website URL:'),
			'#required' => TRUE,
		);
		
        $form['actions']['#type'] = 'actions';
		
        $form['actions']['submit'] = [
			'#type' => 'submit',
			'#id'=>'switchtheme-submit',
			'#value' => $this->t('Submit'),
        ];
		
        return $form;
      }
	  
      /**
       * {@inheritdoc}
      */
		public function validateForm(array &$form, FormStateInterface $form_state) {
		
			$mob = $form_state->getValue('phone');
			if (strlen($mob) < 10) {
			  // Set an error for the form element with a key of "title".
			  $form_state->setErrorByName('phone', $this->t('The mobile no must be at least 10 digit long.'));
			}
				$mail = $form_state->getValue('email');
				
			if (!valid_email_address($mail)) {
				form_set_error('submitted][email_address', t('The email address appears to be invalid.'));
			}
		}
		
		/**
		* {@inheritdoc}
		*/
		public function submitForm(array &$form, FormStateInterface $form_state) {
			$conn = Database::getConnection();
			$conn->insert('custom_form')->fields(
				array(
				'name' => $form_state->getValue('name'),
				'phone' => $form_state->getValue('phone'),
				'email' => $form_state->getValue('email'),
				'website_url' => $form_state->getValue('website_url'),
				)
			)->execute();
			drupal_set_message($this->t('Your application has been submitted!'));
		}
    }
	/* End of the form */