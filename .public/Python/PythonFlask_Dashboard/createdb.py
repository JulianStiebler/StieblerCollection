from website import db, SQLAlchemy
from website.models import likes, followers, Role, UserRoles, Group, UserGroups, Settings, User, Post, Comment, Message, Notification
from flask import Flask

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///database.db'

db = SQLAlchemy(app)
print(app.config["SQLALCHEMY_DATABASE_URI"])