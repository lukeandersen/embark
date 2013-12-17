# Require any additional compass plugins here.
# require "susy"

# General
output_style = :expanded
relative_assets = true
line_comments = true
# Enable source maps in chrome (info: http://bricss.net/post/33788072565/using-sass-source-maps-in-webkit-inspector)
sass_options = { :debug_info => true }


# Sass Paths & Directories
http_path = "/"
css_dir = "/"
sass_dir = "sass"
images_dir = "images"
javascripts_dir = "js"


# Compile production code
# Invoke from command line: compass compile -e production --force
if environment == :production
	output_style = :compact
	line_comments = false
	sass_options = { :debug_info => false }
end
