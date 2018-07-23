from chatterbot import ChatBot
from chatterbot.trainers import ListTrainer
from flask import Flask, render_template, session, abort, request, jsonify ,Response
import jsonpickle 
import os
app = Flask(__name__)
bot = ChatBot('Bot')

def chat_func(message):
	if message.strip() != 'Bye':
		reply = bot.get_response(message)
		return reply
	if message.strip() == 'Bye':
		return 'Bye'

		  
def load_bot():
	bot.set_trainer(ListTrainer)
	for files in os.listdir('C:/Users/JaRvIs/Desktop/cahttttt/chatterbot-corpus-master/chatterbot_corpus/data/custom/'):
		data = open('C:/Users/JaRvIs/Desktop/cahttttt/chatterbot-corpus-master/chatterbot_corpus/data/custom/' + files ,'r').readlines()
		bot.train(data)
		
		
@app.route("/",methods=['POST','GET'])
def main():
	if request.method == "POST":
		msg = request.form['user_input']
		response = chat_func(msg)
		return render_template('test.html',response=response)
		#return Response(json.dumps({'response': pickl}),mimetype='application/json')
		
	if request.method == "GET":
		msg = "Hi!"
		return render_template('test.html',response=msg)

if __name__ == '__main__':
	load_bot()
	app.run(debug = True)