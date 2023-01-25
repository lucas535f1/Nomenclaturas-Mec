<?php

class EventsView extends Events
{
    public function fetchUserEvents($ci)
    {
        return $this->getUserEvents($ci);
    }

    public function fetchAllEvents()
    {
        return $this->getAllEvents();
    }
}
