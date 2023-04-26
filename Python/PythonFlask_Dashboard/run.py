from website import create_app

#Create instance the app
app = create_app()

if __name__ == '__main__':
    app.run(host= '0.0.0.0', debug=True)