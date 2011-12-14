<?php if(isset($venue->mega_image)):?><img src="<?php echo $venue->mega_image; ?>"><?php endif;?><br>
Name: <?php echo $venue->name;?><br>
City: <?php echo $venue->city;?><br><br>

<?php if ( ! $upcoming_events == FALSE ):?>
        <table>
            <caption>Upcoming Events at <?php echo $venue->name; ?></caption>
            <tr>
                <th scope="col" class="name">Event</th>
                <th scope="col">Date</th>
            </tr>
            <?php foreach ($upcoming_events as $int => $event) : ?>
                    <tr<?php echo fmod($int, 2) ? ' class="alt"' : NULL ?>>
                        <td class="name"><?php echo event_link($venue->county, $event->title, $event->event_id); ?></td>
                        <td><?php echo start_date($event->start_date); ?></td>
                    </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        
        <span class="no_events">Sorry. No event listings currently available for this venue. Check back later.</span>
        
    <?php endif; ?>

        
  <?php echo $map['html']; ?>