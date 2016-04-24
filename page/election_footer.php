	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			//HISTORY
			var nav, content, fetchAndInsert;
			
			nav = $('nav#main');
			content = $('section#content');
			
			//Fetches and inserts content into conteiner
			fetchAndInsert = function(href) {
				$.ajax({
					url: href.split('/').pop(),
					method: 'GET',
					cache: false,
					success: function(data) {
						content.html(data);
					}
				});
			};
			
			//User goes back/forward
			$(window).on('popstate', function() {
				fetchAndInsert(location.pathname);
			});
			
			nav.find('a').on('click', function(e) {
				var href = $(this).attr('href');
				
				//Manipulate history
				history.pushState(null, null, href);
				
				//Fetch and insert
				fetchAndInsert(href);
				
				e.preventDefault();
			});
		});
	</script>
	</body>
</html>