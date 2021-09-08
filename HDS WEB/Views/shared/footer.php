<?php
echo "
	</div>
	<div class='bloc_mention'>
		<div class='center_mention'>
			<a href='mentions_legales.php?id=".$sess."' class='mention'>
				HDS 2021. MENTION LEGALE
			</a>
		</div>
	</div>
	<script>
	    function showResponsiveMenu() {
	        var menu = document.getElementById('topnav_responsive_menu');
	        var icon = document.getElementById('topnav_hamburger_icon');
	        var root = document.getElementById('root');
	        if (menu.className === '') {
	          menu.className = 'open';
	          icon.className = 'open';
	          root.style.overflowY = 'hidden';
	        } else {
	          menu.className = '';                    
	          icon.className = '';
	          root.style.overflowY = '';
	        }
	      }
	</script>
	</body>
	</head>
</html>";
?>