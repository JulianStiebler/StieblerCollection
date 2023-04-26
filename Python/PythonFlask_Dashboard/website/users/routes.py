from flask import render_template, url_for, flash, redirect, request, Blueprint, current_app, session
from flask_login import login_user, current_user, logout_user, login_required
from flask_principal import Identity, AnonymousIdentity, identity_changed
from website import db, bcrypt, principals
from website.models import User, Post
from website.users.forms import RegistrationForm, LoginForm, UpdateAccountForm, RequestResetForm, ResetPasswordForm
from website.users.utils import save_picture, send_reset_email
from website.utils import sidebar_entrys, text_user, text_email

users = Blueprint('users', __name__)
#Register a account
@users.route("/register/", methods=['GET', 'POST'])
def register():
    if current_user.is_authenticated:
        return redirect(url_for('dashboard.home'))

    form = RegistrationForm()
    if form.validate_on_submit():
        hashed_password = bcrypt.generate_password_hash(form.password.data).decode('utf-8')
        user = User(username=form.username.data, email=form.email.data, password=hashed_password)
        db.session.add(user)
        db.session.commit()
        flash(text_user["new"], "success")
        return redirect(url_for('users.login'))

    return render_template('user/register.html', title='Register', form=form)

#Login route
@users.route("/login/", methods=['GET', 'POST'])
def login():
    if current_user.is_authenticated:
        return redirect(url_for('dashboard.home'))

    form = LoginForm()
    if form.validate_on_submit():
        user = User.query.filter_by(email=form.email.data).first()
        if user and bcrypt.check_password_hash(user.password, form.password.data):
            #Login the user
            login_user(user, remember=form.remember.data)
            #Principals identitiy
            identity_changed.send(current_app._get_current_object(), identity=Identity(user.id))
            return redirect(url_for('dashboard.home'))
        else:
            flash(text_user["login_fail"], "warning")
    return render_template('user/login.html', title='Login', form=form)

#Logout route
@users.route("/logout/")
def logout():
    # Remove the user information from the session
    logout_user()

    # Remove session keys set by Flask-Principal
    for key in ('identity.name', 'identity.auth_type'):
        session.pop(key, None)

    # Tell Flask-Principal the user is anonymous
    identity_changed.send(current_app._get_current_object(), identity=AnonymousIdentity())
    return redirect(url_for('dashboard.home'))

#Account Page
@users.route("/account/", methods=['GET', 'POST'])
@login_required
def account():
    posts = sidebar_entrys()
    entrys = Post.query.filter_by(author=current_user).order_by(Post.date_posted.desc()).limit(3)
    form = UpdateAccountForm()
    if form.validate_on_submit():
        if form.picture.data:
            picture_file = save_picture(form.picture.data)
            current_user.image_file = picture_file
        current_user.username = form.username.data
        current_user.email = form.email.data
        db.session.commit()
        flash(text_user["settings_saved"], "success")
        return redirect(url_for('users.account'))
    elif request.method == 'GET':
        form.username.data = current_user.username
        form.email.data = current_user.email
        
    image_file = url_for('static', filename='profile_pics/' + current_user.image_file)
    return render_template('user/account.html', title='My Account', image_file=image_file, form=form, posts=posts, entrys=entrys)

#Create a reset-request
@users.route("/account/reset/request/", methods=['GET', 'POST'])
def reset_request():
    if current_user.is_authenticated:
        send_reset_email(current_user)
        flash(text_email["resetpw"], "success")
        return redirect(url_for('users.login'))

    form = RequestResetForm()
    if form.validate_on_submit():
        user = User.query.filter_by(email=form.email.data).first()
        send_reset_email(user)
        flash(text_email["resetpw"], "success")
        return redirect(url_for('users.login'))
    return render_template('user/reset_request.html', title='Reset Password', form=form)

#Accept a valid token for reset
@users.route("/account/reset/request/<token>", methods=['GET', 'POST'])
def reset_request_submit(token):
    user = User.verify_reset_token(token)
    if user is None:
        flash(text_user["invalid_token"], "warning")
        return redirect(url_for('users.reset_request'))
    form = ResetPasswordForm()
    if form.validate_on_submit():
        hashed_password = bcrypt.generate_password_hash(form.password.data).decode('utf-8')
        user.password = hashed_password
        db.session.commit()
        if current_user.is_authenticated:
            logout_user()
            return redirect(url_for('dashboard.home'))
        flash(text_email["resetpw_success"], "success")
        return redirect(url_for('users.login'))
    return render_template('user/reset_request_submit.html', title='Reset Password', form=form)

