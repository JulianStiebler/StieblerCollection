from flask import Flask
from flask_sqlalchemy import SQLAlchemy
from flask_bcrypt import Bcrypt
from flask_login import LoginManager
from flask_mail import Mail
from website.config import Config
from flask_principal import Principal, Permission, RoleNeed
import sys

sys.dont_write_bytecode = True
db = SQLAlchemy()
bcrypt = Bcrypt()
login_manager = LoginManager()
login_manager.login_view = 'users.login'
login_manager.session_protection = "strong"
mail = Mail()
principals = Principal()


def create_app(config_class=Config):
    app = Flask(__name__)
    app.config["SECRET_KEY"] = '541eb7aba229e3fedd77f9b7d57b0b89'
    app.config["SQLALCHEMY_DATABASE_URI"] = 'sqlite:///instance/site.db'



    app.config.from_object(Config)

    db.init_app(app)
    bcrypt.init_app(app)
    login_manager.init_app(app)
    mail.init_app(app)
    principals.init_app(app)

    from website.legal.routes import legal
    from website.users.routes import users
    from website.errors.handlers import errors
    from website.dashboard.routes import dashboard
    from website.documentation.routes import documentation

    app.register_blueprint(legal)
    app.register_blueprint(dashboard)
    app.register_blueprint(users)
    app.register_blueprint(errors)
    app.register_blueprint(documentation)

    admin_permission = Permission(RoleNeed('admin'))
    return app