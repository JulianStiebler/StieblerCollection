from flask import render_template, Blueprint, redirect, url_for, request, flash, abort
from flask_login import current_user, logout_user, login_required
from website import db
from website.models import Post, User
from website.utils import sidebar_entrys
from website.documentation.forms import entryForm

documentation = Blueprint('documentation', __name__)

@documentation.route("/documentation/")
@login_required
def documentation_home():
    posts = sidebar_entrys()

    page = request.args.get('page', 1, type=int)
    entrys = Post.query.order_by(Post.date_posted.desc()).paginate(page=page, per_page=3)

    return render_template('documentation/documentation.html', posts=posts, entrys=entrys, title='Documentation')

@documentation.route("/documentation/new", methods=['GET', 'POST'])
@login_required
def new_entry():
    posts = sidebar_entrys()
    form = entryForm()
    if form.validate_on_submit():
        entry = Post(title=form.title.data, content=form.content.data, author=current_user, category=form.category.data)
        db.session.add(entry)
        db.session.commit()
        flash('Your entry has been created!', 'success')
        return redirect(url_for('documentation.documentation_home'))
    return render_template('documentation/documentation_create.html', title='New entry',
                           form=form, legend='New entry', posts=posts)


@documentation.route("/documentation/<int:entry_id>")
def entry(entry_id):
    posts = sidebar_entrys()
    entry = Post.query.get_or_404(entry_id)
    return render_template('documentation/documentation_entry.html', title=entry.title, entry=entry, posts=posts)


@documentation.route("/documentation/<int:entry_id>/update", methods=['GET', 'POST'])
@login_required
def update_entry(entry_id):
    posts = sidebar_entrys()
    entry = Post.query.get_or_404(entry_id)
    if entry.author != current_user:
        abort(403)
    form = entryForm()
    if form.validate_on_submit():
        entry.title = form.title.data
        entry.content = form.content.data
        db.session.commit()
        flash('Your entry has been updated!', 'success')
        return redirect(url_for('documentation.entry', entry_id=entry.id))
    elif request.method == 'GET':
        form.title.data = entry.title
        form.category.data = entry.category
        form.content.data = entry.content
    return render_template('documentation/documentation_create.html', title='Update entry',
                           form=form, legend='Update entry', posts=posts)


@documentation.route("/documentation/<int:entry_id>/delete", methods=['POST'])
@login_required
def delete_entry(entry_id):
    entry = Post.query.get_or_404(entry_id)
    if entry.author != current_user:
        abort(403)
    db.session.delete(entry)
    db.session.commit()
    flash('Your entry has been deleted!', 'success')
    return redirect(url_for('documentation.documentation_home'))

@documentation.route("/documentation/by/<string:username>")
def user_entrys(username):
    posts = sidebar_entrys()

    page = request.args.get('page', 1, type=int)
    user = User.query.filter_by(username=username).first_or_404()

    entrys = Post.query.filter_by(author=user)\
        .order_by(Post.date_posted.desc())\
        .paginate(page=page, per_page=5)

    return render_template('documentation/documentation_byuser.html', posts=posts, user=user, entrys=entrys)

@documentation.route("/documentation/category/<string:category>")
def by_category(category):
    posts = sidebar_entrys()

    page = request.args.get('page', 1, type=int)

    entrys = Post.query.filter_by(category=category)\
        .order_by(Post.date_posted.desc())\
        .paginate(page=page, per_page=5)

    return render_template('documentation/documentation_bycategory.html', posts=posts, entrys=entrys, category=category)