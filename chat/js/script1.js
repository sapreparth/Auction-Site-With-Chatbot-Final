$(document).ready(function(){
	
   $('.msg_head').click(function(){
		$('.msg_wrap').slideToggle('slow');
	});
	
	$('.close').click(function(){
		$('.msg_box').hide();
	});
	
	$('.user').click(function(){

		$('.msg_wrap').show();
		$('.msg_box').show();
	});
	
	var trigger = [
	["hi","hey","hello"], 
	["how are you", "how is life", "how are things"],
	["what are you doing", "what is going on"],
	["how old are you"],
	["who are you", "are you human", "are you bot", "are you human or bot"],
	["who created you", "who made you"],
	["your name please",  "your name", "may i know your name", "what is your name"],
	["i love you"],
	["happy", "good"],
	["bad", "bored", "tired"],
	["help me", "tell me story", "tell me joke"],
	["ah", "yes", "ok", "okay", "nice", "thanks", "thank you"],
	["bye", "good bye", "goodbye", "see you later"],
	["how do i register","how can i start bidding in auctions","how do i login"],
	["how can i give an item for auction","how do i put an item for auction","how can i start an auction","how do i start an auction"],
	["what time does it take to approve an item"],
	["when will i get the payment","when will i be paid"],
	["when  will the auction start","how long does the auction lasts"],
	["what type of items can i auction"]
   ];

   var reply = [
	["Hi","Hey","Hello"], 
	["Fine", "Pretty well", "Fantastic"],
	["Nothing much", "About to go to sleep", "Can you guest?", "I don't know actually"],
	["I am 1 day old"],
	["I am just a bot and i am not a terrorist", "I am a bot. What are you?", "My name is chetti speed one terrabyte"],
	["Kani Veri", "My God"],
	["I am nameless", "I don't have a name"],
	["I love you too", "Me too"],
	["Have you ever felt bad?", "Glad to hear it"],
	["Why?", "Why? You shouldn't!", "Try watching TV"],
	["I will", "What about?"],
	["Tell me a story", "Tell me a joke", "Tell me about yourself", "You are welcome"],
	["Bye", "Goodbye", "See you later"],
	["Well first register yourself in signup page"],
	["After signing up upload an item and after we approve an item it will be up for auction"],
	["Usually it takes three to four days"],
	["After we recive payment from the bidder we will pay you in one or two working days after deducting our fees"],
	["It is mentioned in the item description"],
	["Items under electronic furniture music sports and many more to come"]
   ];

    var alternative = ["Ask Master Bot", "Please correct your grammar"];


	
	$('textarea').keypress(
    function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            var msg = $(this).val();
		    $(this).val('');
			if(msg!='')
			$('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
			output(msg);
			$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
			
        }
    });
	
	function output(msg){
	try{
		var product = msg + "=" + eval(msg);
	} catch(e){
			var text = (msg.toLowerCase()).replace(/[^\w\s\d]/gi, ""); //remove all chars except words, space and 
			text = text.replace(/ a /g, " ").replace(/i feel /g, "").replace(/whats/g, "what is").replace(/please /g, "").replace(/ please/g, "");
			if(compare(trigger, reply, text)){
				var product = compare(trigger, reply, text);
			} else {
				var product = alternative[Math.floor(Math.random()*alternative.length)];
			}
		}
		$('<div class="msg_a">'+product+'</div>').insertBefore('.msg_push');
		speak(product);
	}

	function compare(arr, array, string){
		var item;
		for(var x=0; x<arr.length; x++){
			for(var y=0; y<array.length; y++){
				if(arr[x][y] == string){
					items = array[x];
					item =  items[Math.floor(Math.random()*items.length)];
				}
			}
		}
		return item;
	}
	
	function speak(string){
	var utterance = new SpeechSynthesisUtterance();
	utterance.voice = speechSynthesis.getVoices().filter(function(voice){return voice.name == "Agnes";})[0];
	utterance.text = string;
	utterance.lang = "en-US";
	utterance.volume = 1; //0-1 interval
	utterance.rate = 1;
	utterance.pitch = 2; //0-2 interval
	speechSynthesis.speak(utterance);
    }
	
});