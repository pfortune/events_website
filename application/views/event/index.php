<div id="main">

    <section>
    <?php if ( ! $events == FALSE ):?>
        <table>
            <caption>Upcoming Events</caption>
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
    <?php else: ?>
        
        <span class="no_events">Sorry. No event listings currently available for <?php echo ucfirst($this->uri->segment(1)); ?>. Check back later.</span>
        
    <?php endif; ?>
    </section>
</div>