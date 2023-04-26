from flask import render_template, Blueprint
from website import db
from website.utils import sidebar_entrys

legal = Blueprint('legal', __name__)

#Render about page
@legal.route("/about/")
def about():
    posts = sidebar_entrys()
    return render_template('about.html', title = 'About', posts=posts)

#Render Cookie policy page
@legal.route("/about/cookies")
def cookiepolicy():
    posts = sidebar_entrys()
    return render_template('about.html', title = 'Cookie Policy', posts=posts)

#Render Impressum page
@legal.route("/about/impressum")
def impressum():
    posts = sidebar_entrys()
    return render_template('about.html', title = 'Impressum', posts=posts)


#Render privacy policy page
@legal.route("/about/data")
def privacypolicy():
    posts = sidebar_entrys()
    return render_template('about.html', title = 'Privacy Policy', posts=posts)
    
#Render Terms of Service page
@legal.route("/about/tos")
def termsofservice():
    posts = sidebar_entrys()
    return render_template('about.html', title = 'Terms of Service', posts=posts)
