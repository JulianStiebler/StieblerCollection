from flask import render_template, Blueprint, redirect, url_for
from flask_login import current_user, logout_user, login_required
from website import db
from website.models import Post
from website.utils import sidebar_entrys
from website.dashboard.utils import graph_horizontal_dynamic, get_cases

dashboard = Blueprint('dashboard', __name__)

@dashboard.route("/")
def home():
    if current_user.is_authenticated:
        return redirect(url_for('dashboard.dashboard_home'))
    return render_template('main.html', title='Welcome')

@dashboard.route("/dashboard/")
@login_required
def dashboard_home():
    posts = sidebar_entrys()
    dataset = []
    dataset.append({"width":200, "height":200, "spacing":0, "margin":0, "title":"Corona", "labels":"1,2,3,4,5", "info":"Corona Cases", "record":{1,2,3,4,5}})
    dataset.append({"width":200, "height":200, "spacing":0, "margin":0, "title":"Corona", "labels":"1,2,3,4,5", "info":"Corona Cases", "record":{1,2,3,4,5}})
    dataset.append({"width":200, "height":200, "spacing":0, "margin":0, "title":"Corona", "labels":"1,2,3,4,5", "info":"Corona Cases", "record":{1,2,3,4,5}})
    dataset.append({"width":200, "height":200, "spacing":0, "margin":0, "title":"Corona", "labels":"1,2,3,4,5", "info":"Corona Cases", "record":{1,2,3,4,5}})
    dataset.append({"width":200, "height":200, "spacing":0, "margin":0, "title":"Corona", "labels":"1,2,3,4,5", "info":"Corona Cases", "record":{1,2,3,4,5}})
    
    
    graphs = graph_horizontal_dynamic(dataset)

    return render_template('dashboard/dashboard.html', title='Dashboard', posts=posts, graphs=graphs)

@dashboard.route("/dashboard/justice/")
@login_required
def dashboard_justice():
    posts = sidebar_entrys()
    cases = get_cases(10)

    return render_template('dashboard/dashboard_justice.html', title='Justice', posts=posts, cases=cases)

@dashboard.route("/dashboard/controller/")
@login_required
def dashboard_controller():
    posts = sidebar_entrys()
    return render_template('dashboard/dashboard_controller.html', title='Controller', posts=posts)

@dashboard.route("/dashboard/users/")
@login_required
def dashboard_users():
    posts = sidebar_entrys()
    return render_template('dashboard/dashboard_users.html', title='Users', posts=posts)

