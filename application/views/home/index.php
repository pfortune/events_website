<div id="main">  

	<section class="box">
		<h1>Upcoming Events in <?php echo $county; ?></h1>
		
		<?php if ( $local === FALSE ): ?>
		
			Oops, no events coming up in <?php echo $county; ?>. Check below for upcoming events all over Ireland.
		
		<?php else: ?>
			<table>
	            <tr>
	                <th scope="col">Date</th>
	                <th scope="col" class="name">Event</th>
	                <th scope="col" class="name">Venue/Location</th>
	            </tr>
			<?php foreach ($local as $int => $event) : ?>
                <?php if (isset($event->county)): ?>
                    <tr<?php echo fmod($int, 2) ? ' class="alt"' : NULL ?>>
                        <td><?php echo start_date($event->start_date, 'short-day'); ?></td>
                        <td class="name"><?php echo event_link($event->county, $event->title, $event->event_id); ?></td>
                        <td class="name"><?php echo venue_link($event->venue_id, $event->county, $event->venue); ?> <?php echo $event->city; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
       </table>
			
		<?php endif;?>
	</section>
	
    <section class="box">
        <table>
            <caption>Top 10 Upcoming Events in Ireland</caption>
            <tr>
                <th scope="col">Date</th>
                <th scope="col" class="name">Event</th>
                <th scope="col" class="name">Venue/Location</th>
            </tr>
            <?php foreach ($events as $int => $event) : ?>
                <?php if (isset($event->county)): ?>
                    <tr<?php echo fmod($int, 2) ? ' class="alt"' : NULL ?>>
                        <td><?php echo start_date($event->start_date, 'short-day'); ?></td>
                        <td class="name"><?php echo event_link($event->county, $event->title, $event->event_id); ?></td>
                        <td class="name"><?php echo venue_link($event->venue_id, $event->county, $event->venue); ?> <?php echo $event->city; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </section>
</div>
