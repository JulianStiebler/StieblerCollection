class Config:
    PYTHONDONTWRITEBYTECODE = '1'
    SECRET_KEY = '541eb7aba229e3fedd77f9b7d57b0b89'
    SQLALCHEMY_DATABASE_URI = 'sqlite:///website/data/site.db'
    #SECRET_KEY = os.environ.get('SECRET_KEY')
    #SQLALCHEMY_DATABASE_URI = os.environ.get('SQLALCHEMY_DATABASE_URI')
    SQLALCHEMY_TRACK_MODIFICATIONS = False
    MAIL_SERVER = 'smtp.gmail.com'
    MAIL_PORT = 587
    MAIL_USE_TLS = True
    MAIL_USERNAME = 'stiebapi.help@gmail.com'
    MAIL_PASSWORD = 'indevelop'
    #MAIL_USERNAME = os.environ.get('EMAIL_USER')
    #MAIL_PASSWORD = os.environ.get('EMAIL_PASS')
    UPLOAD_FOLDER = '/data/uploads/'
    ALLOWED_EXTENSIONS = {'mp4', 'flv', 'png', 'jpg', 'jpeg', 'gif'}

