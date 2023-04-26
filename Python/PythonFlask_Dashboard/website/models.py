import json
from time import time
from datetime import datetime
from website import db, login_manager
from flask import current_app
from flask_login import UserMixin
from itsdangerous.url_safe import URLSafeTimedSerializer as Serializer

#likes, followers, Role, UserRoles, Group, UserGroups, Settings, User, Post, Controller, Comment, Message, Notification

#Define where to find User for login_manager ------------------------------------------------------------------------------------------------------------
@login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))

#Like Models -----------------------------------------------------------------------------------------------------------------------------------------
class likes(db.Model):
    __tablename__ = 'post_like'
    id = db.Column(db.Integer, primary_key=True)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    post_id = db.Column(db.Integer, db.ForeignKey('post.id'))

#Followers Model -----------------------------------------------------------------------------------------------------------------------------------------
class followers(db.Model, UserMixin):
    __tablename__ = 'followers'
    id = db.Column(db.Integer, primary_key=True)
    follower_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    followed_id = db.Column(db.Integer, db.ForeignKey('user.id'))

#User-Roles Model -----------------------------------------------------------------------------------------------------------------------------------------
class Role(db.Model):
    __tablename__ = 'roles'
    id = db.Column(db.Integer(), primary_key=True)
    name = db.Column(db.String(50), unique=True)
    description = db.Column(db.Text)

class UserRoles(db.Model):
    __tablename__ = 'user_roles'
    id = db.Column(db.Integer(), primary_key=True)
    user_id = db.Column(db.Integer(), db.ForeignKey('user.id', ondelete='CASCADE'))
    role_id = db.Column(db.Integer(), db.ForeignKey('roles.id', ondelete='CASCADE'))

#User-Groups Model -----------------------------------------------------------------------------------------------------------------------------------------
class Group(db.Model):
    __tablename__ = 'groups'
    id = db.Column(db.Integer(), primary_key=True)
    name = db.Column(db.String(50), unique=True)
    grouptype = db.Column(db.String(50), default='Primary')
    description = db.Column(db.Text)

class UserGroups(db.Model):
    __tablename__ = 'user_groups'
    id = db.Column(db.Integer(), primary_key=True)
    user_id = db.Column(db.Integer(), db.ForeignKey('user.id', ondelete='CASCADE'))
    role_id = db.Column(db.Integer(), db.ForeignKey('groups.id', ondelete='CASCADE'))

#Settings Model -----------------------------------------------------------------------------------------------------------------------------------------
class Settings(db.Model):
    id = db.Column(db.Integer(), primary_key=True)
    user_id = db.Column(db.Integer(), db.ForeignKey('user.id'))
    privacy_showvatar = db.Column(db.Boolean, default=True)
    privacy_showfriends = db.Column(db.Boolean, default=True)
    privacy_showinformation = db.Column(db.Boolean, default=True)
    privacy_showonlyforfriends = db.Column(db.Boolean, default=False)
    privacy_allownonfriendmessage = db.Column(db.Boolean, default=True)
    
#User Model -----------------------------------------------------------------------------------------------------------------------------------------
class User(db.Model, UserMixin):
    #Important register information
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(20), unique=True, nullable=False)
    password = db.Column(db.String(60), nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)

    #Default account state
    firstname = db.Column(db.String(25))
    surname = db.Column(db.String(25))
    country = db.Column(db.String(30))
    postal = db.Column(db.Integer)
    city = db.Column(db.String(30))
    street = db.Column(db.String(50))
    extid = db.Column(db.String(50))
    description = db.Column(db.Text)

    #Side information
    image_file = db.Column(db.String(20), nullable=False, default='default.jpg')
    activites = db.Column(db.Text)
    
    #Important side information
    date_joined = db.Column(db.DateTime, nullable=False, default=datetime.utcnow)
    tracking = db.Column(db.Text)

    #Relations, whove created this for the specific other models
    post = db.relationship('Post', backref='author', lazy=True)
    controller = db.relationship('Controller', backref='controller', lazy=True)
    roles = db.relationship('Role', secondary='user_roles')
    groups = db.relationship('Group', secondary='user_groups')
    settings = db.relationship('Settings', backref='settings', lazy=True)

    #Notification Logic
    notifications = db.relationship('Notification', backref='user',
                                    lazy='dynamic')

    #Message logic
    messages_sent = db.relationship('Message',
                                    foreign_keys='Message.sender_id',
                                    backref='author', lazy='dynamic')
    messages_received = db.relationship('Message',
                                        foreign_keys='Message.recipient_id',
                                        backref='recipient', lazy='dynamic')
    last_message_read_time = db.Column(db.DateTime)

    def new_messages(self):
        last_read_time = self.last_message_read_time or datetime(1900, 1, 1)
        return Message.query.filter_by(recipient=self).filter(
            Message.timestamp > last_read_time).count()

    #Relationship to Likes
    liked = db.relationship('likes', foreign_keys='likes.user_id', backref='likes', lazy='dynamic')

    #Like logic
    def like_post(self, post):
        if not self.has_liked_post(post):
            like = likes(user_id=self.id, post_id=post.id)
            db.session.add(like)

    def unlike_post(self, post):
        if self.has_liked_post(post):
            likes.query.filter_by(
                user_id=self.id,
                post_id=post.id).delete()

    def has_liked_post(self, post):
        return likes.query.filter(
            likes.user_id == self.id,
            likes.post_id == post.id).count() > 0

    #Follower logic
    followed = db.relationship('followers', foreign_keys='followers.followed_id', backref='followers', lazy='dynamic')

    def follow(self, user):
        if not self.is_following(user):
            follow = followers(follower_id=self.id, followed_id=user.id)
            db.session.add(follow)

    def unfollow(self, user):
        if self.is_following(user):
            followers.query.filter_by(
                follower_id=self.id,
                followed_id=user.id).delete()

    def is_following(self, user):
        return followers.query.filter(
            followers.follower_id == self.id,
            followers.followed_id == user.id).count() > 0
    
    def followed_posts(self):
        followed = Post.query.join(followers, (followers.followed_id == Post.id)).filter(followers.follower_id == self.id)
        own = Post.query.filter_by(user_id=self.id)
        return followed.union(own).order_by(Post.timestamp.desc())

    #Password reset logic
    def get_reset_token(self, expires_sec=1800):
        s = Serializer(current_app.config['SECRET_KEY'], expires_sec)
        return s.dumps({'user_id': self.id}).decode('utf-8')

    @staticmethod
    def verify_reset_token(token):
        s = Serializer(current_app.config['SECRET_KEY'])
        try:
            user_id = s.loads(token)['user_id']
        except:
            return None
        return User.query.get(user_id)

    def __repr__(self):
        return f"User('{self.username}', '{self.email}', '{self.firstname}', '{self.surname}', '{self.country}', '{self.postal}', '{self.city}', '{self.street}', '{self.extid}', '{self.description}', '{self.image_file}', '{self.activites}', '{self.date_joined}')"

#Post Model -----------------------------------------------------------------------------------------------------------------------------------------
class Post(db.Model, UserMixin):
    #General Information
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(100), nullable=False)
    category = db.Column(db.String(100))
    content = db.Column(db.Text, nullable=False)
    date_posted = db.Column(db.DateTime, nullable=False, default=datetime.utcnow)

    #Side information
    attachments = db.Column(db.String(100))
    extid = db.Column(db.String(50))

    #Relationships
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
    likes = db.relationship('likes', backref='postlikes', lazy='dynamic')

    def __repr__(self):
        return f"Post('{self.title}', '{self.style}', '{self.category}', '{self.content}', '{self.date_posted}', '{self.attachments}', '{self.extid}', '{self.likes}')"

#Controller Model -----------------------------------------------------------------------------------------------------------------------------------------
class Controller(db.Model, UserMixin):
    #General Information
    id = db.Column(db.Integer, primary_key=True)
    date_posted = db.Column(db.DateTime, nullable=False, default=datetime.utcnow)
    name = db.Column(db.String(100), nullable=False)
    category = db.Column(db.String(25), nullable=False)
    description = db.Column(db.Text)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)

    #Sensitive Data
    gateway = db.Column(db.String(100), nullable=False)
    location = db.Column(db.String(100), nullable=False)
    interaction = db.Column(db.Text)

    def __repr__(self):
        return f"Controller('{self.date_posted}', '{self.name}', '{self.category}', '{self.description}', '{self.gateway}', '{self.location}')"

#Comments Model -----------------------------------------------------------------------------------------------------------------------------------------
class Comment(db.Model):
    #Mangitude of power for comments, 6 ~= 1Mil 
    _N = 6

    #General information
    id = db.Column(db.Integer, primary_key=True)
    text = db.Column(db.String(140))
    author = db.Column(db.String(32))
    timestamp = db.Column(db.DateTime(), default=datetime.utcnow, index=True)
    path = db.Column(db.Text, index=True)
    parent_id = db.Column(db.Integer, db.ForeignKey('comment.id'))
    replies = db.relationship(
        'Comment', backref=db.backref('parent', remote_side=[id]),
        lazy='dynamic')

    #Comment logic
    def save(self):
        db.session.add(self)
        db.session.commit()
        prefix = self.parent.path + '.' if self.parent else ''
        self.path = prefix + '{:0{}d}'.format(self.id, self._N)
        db.session.commit()
    
    def delete(self):
        db.session.delete(self)
        db.session.commit()
        prefix = self.parent.path + '.' if self.parent else ''
        self.path = prefix + '{:0{}d}'.format(self.id, self._N)
        db.session.commit()

    def level(self):
        return len(self.path) // self._N - 1

    def __repr__(self):
        return f"Comment('{self.id}', '{self.text}', '{self.author}', '{self.timestamp}', '{self.path}', '{self.parent_id}')"

#Message Model -----------------------------------------------------------------------------------------------------------------------------------------
class Message(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    sender_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    recipient_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    body = db.Column(db.String(140))
    timestamp = db.Column(db.DateTime, index=True, default=datetime.utcnow)

    def __repr__(self):
        return '<Message {}>'.format(self.body)

#Notifications Model -----------------------------------------------------------------------------------------------------------------------------------------
class Notification(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(128), index=True)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    timestamp = db.Column(db.Float, index=True, default=time)
    payload_json = db.Column(db.Text)

    def get_data(self):
        return json.loads(str(self.payload_json))