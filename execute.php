		<?php
		//file necessari ad inviare foto, doc e audio
		require 'class-http-request.php';
		require 'functions.php';
		//modificare col vostro token del bot
		$api="771045308:AAGZb55GrF7Lw5DQF-hu-8IVgVWjPK4f9xQ";
		
		
		//prendo quello che mi è arrivato e lo salvo nella variabile content
		$content = file_get_contents("php://input");
		//decodifico quello che mi è arrivato
		$update = json_decode($content, true);
		//se non sono riuscito a decodificarlo mi fermo
		if(!$update)
		{
		  exit;
		}

        //altrimenti proseguo e vado a leggere il messaggio salvandolo nella variabile 
		//message
		$message = isset($update['message']) ? $update['message'] : "";
		//facciamo la stessa cosa anche per l'id del mess.
		$messageId = isset($message['message_id']) ? $message['message_id'] : "";
		//l'id della chat che servirà al nostro bot per sapere a chi risponder
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		//il nome dell'utente che ha scritto
		$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
		//il cognome
		$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
		//lo username
		$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
		//la data
		$date = isset($message['date']) ? $message['date'] : "";
		//ed il testo del messaggio
		$text = isset($message['text']) ? $message['text'] : "";
        //eliminiamo gli spazi con trim e convertiamo in minuscolo con la funz strtolower
		
		$text = trim($text);
		$text = strtolower($text);
        
		//$text = json_encode($message);
		 //costruiamo la risposta del nostro bot
		 //l'header è sempre uguale ed indica che sarà un messaggio con codifica
		 //JSON
		header("Content-Type: application/json");
		//i parametri sono cosa voglio mandare indietro al mio utente, rimando il testo che
		//ho ricevuto e che si trova nella variabile $text
		$parameters = array('chat_id' => $chatId, "text" => $text);
		
		if($text == "data" ||$text =="/data"){
			$text="La data odierna è: ".date("d.m.y");
			$parameters = array('chat_id' => $chatId, "text" => $text);
		}
		if($text == "saluto"){
			$text="viva il Duce!";
			$parameters = array('chat_id' => $chatId, "text" => $text);
		}
		if($text == "foto"||$text =="/foto"){
			sendfoto($chatId,"Benito.jpg",false,"la mia foto", $api);
		}

		if($text == "barz"){
			$barz[0]="- Mamma, com'è possibile che io riesco a risolvere il cubo di Rubik in pochi secondi e ad altri bambini serve molto più tempo? Perché tu sei daltonico."
			/*$barz[3]="- Dottoressa, c'è l'ho duro 24 ore al giorno, cosa mi può dare?
				- Vitto, alloggio e 800 euro al mese.";
			$barz[2]="- Qual è la differenza tra Lui e Lei mentre fanno l'amore?
				- Nessuna! Lui c'è l'ha dentro e Lei c'è l'ha dentro.";
			$barz[1]="Due amiche parlano di sesso:
				- Tu dici al tuo marito quando raggiungi l'orgasmo?
				- Ma no, non voglio disturbarlo mentre è in ufficio.";*/
			$i = rand(0,3);
			$parameters = array('chat_id' => $chatId, "text" => $text => $barz[0]);
		
		//aggiungo il comando di invio
		//e lo invio
		
		$parameters["method"] = "sendMessage";
        echo json_encode($parameters);
		
		
		
		
		
		
		?>
		
		
		
		
		
		

		
		
		
