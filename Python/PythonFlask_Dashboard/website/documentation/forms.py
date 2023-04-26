from flask_wtf import FlaskForm
from flask_wtf.file import FileField, FileAllowed
from wtforms import StringField, SubmitField, TextAreaField
from wtforms.validators import DataRequired
from flask import current_app

extensions = {'mp4', 'flv', 'png', 'jpg', 'jpeg', 'gif'}
class entryForm(FlaskForm):
    title = StringField('Title', validators=[DataRequired()])
    content = TextAreaField('Content', validators=[DataRequired()])
    category = StringField('Categorys - multiple split by , (comma)', validators=[DataRequired()])
    attachments = FileField('Attachments', validators=[FileAllowed([extensions])])
    submit = SubmitField('Create')