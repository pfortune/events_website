

<div id="profile">
    
  <section>
  <article>
	<header>
        <h2><?php echo $event->title; ?></h2>
	    <time datetime="<?php echo $event->start_date;?>"><?php echo start_time($event->start_date); ?> on <?php echo start_date($event->start_date); ?></time>
    </header>
		
	<p>
		<?php echo $event->description; ?>
	    Start Date: <?php echo start_date($event->start_date); ?><br>
		Start Time: <?php echo start_time($event->start_date); ?><br>
	</p>			
  </article>

  <article>
		<h2>Venue Details</h2>
		Venue: <?php echo $venue->name; ?><br>
		
		<div class="vcard">
		</div>
		
		<nav>
			<ul>
				<li>Show on Map</li>
				<li>Other Events at <?php echo venue_link($venue->venue_id,$venue->county,$venue->name); ?></li>
				<li>Other Events in <?php echo events_link($venue->county); ?></li>
			</ul>
		</nav>
	</article>
	
    <div id="map">
		<h2>Directions to <?php echo $venue->name; ?></h2>
		
        <?php echo $map['html']; ?>
    </div>

	<article>
		<h2>Similar Events</h2>
		<?php foreach($similar_events as $event) :?>
			<?php if($event->event_id !== $this->uri->segment(4)): ?>
	      <ul>
			<li>Title: <?php echo event_link($this->uri->segment(1), $event->title, $event->event_id); ?></li>
			<li>City: <?php echo $event->city; ?></li>
			<li>Venue: <?php echo $event->venue; ?></li>
			<li>Time: <?php echo start_time($event->start_date); ?></li>
			<li>Date: <?php echo start_date($event->start_date); ?></li>
	      </ul>	
		<hr>
		<?php else: continue; endif; ?>
		<?php endforeach; ?>
	</article>
  </section>
</div>
