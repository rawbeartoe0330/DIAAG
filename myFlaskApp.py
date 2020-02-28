# import Flask
import csv
from flask import Flask, jsonify, request
from flask import render_template
import sqlite3 as sq
import _mysql_connector as ms
import datetime
import time


app = Flask(__name__)


# create URL and function mapping /
@app.route('/', methods=['GET', 'POST'])
def index():

    return "This is a POST Method - mooving forward!"


# create another mapping
@app.route('/hello')
def hello():
    return "Hello Again RAW - this is Flask in the hello"


# mapping to call a template
@app.route('/search')
def showprofile():
    return render_template('profile.html')


# mapping to call a template
@app.route('/response')
def showsizes():
    return "done"


@app.route('/placeholder')
def showplaceholderdata():
    return "done"


if __name__ == '__main__':
    app.run()
