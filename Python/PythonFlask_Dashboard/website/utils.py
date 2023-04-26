from website.models import Post
from flask import request

def sidebar_entrys():
    entrys = Post.query.order_by(Post.date_posted.desc()).limit(10).all()
    return entrys

text_email = {
    "resetpw":"An email has been sent with instructions to reset your password.",
    "resetpw_success":"Your password has been updated! You are now able to log in."
}

text_user = {
    "new":"Account succesfully created.",
    "login_fail":"Login failed. Please check your e-mail and/or password.",
    "settings_saved":"Settings saved.",
    "invalid_token":"This token is either invalid or expired."
}
    
text_validation = {
    "error_username":"This username is already taken. Choose another one.",
    "error_email":"This E-Mail is already in use. Choose another one.",
    "error_tos":"You need to accept the Terms of Service and Data Policy."
}
