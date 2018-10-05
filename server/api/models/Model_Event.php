<?php

class Model_Event {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function getEventById($id){
        $this->events = array($id);
        $data = array($id);
        $sql = "SELECT `id`,`start_time`, `end_time`, `id_employee`, `id_room`, `specifics`, `add_event_time` 
                FROM `events`
                WHERE `id`=?";

        $result = $this->db->queryFetch($sql, $data);
        if ($result){
            $event = array();
            $event['id'] = $result['id'];
            $event['startTime'] = date('H:i', $result['start_time']);
            $event['endTime'] = date('H:i', $result['end_time']);
            $event['idEmployee'] = $result['id_employee'];
            $event['idRoom'] = $result['id_room'];
            $event['specifics'] = $result['specifics'];
            $event['addEventTime'] = $result['add_event_time'];
            return $event;
        }
    }

    public function deleteEvent($id, $recurr_group_id = 0)
    {
        if ($recurr_group_id != 0)
        {
            $data = array($id);
            $sql = "DELETE FROM `events` WHERE `id_recursive`=?";
        } else {
            $data = array($id);
            $sql = "DELETE FROM `events` WHERE `id`=?";
        }
        
        $this->db->queryFetch($sql, $data);
    }

    public function addEvent(Event $event)
    {
                $data = array(
                    $event->startTime
                    , $event->endTime
                    , $event->idEmployee
                    , $event->idRoom
                    , $event->specifics
            );

        $sql = "INSERT INTO `events` (`start_time`, `end_time`, `user_id`, `room_id`, `description`)
                VALUES (?,?,?,?,?)";
        $this->db->queryFetch($sql, $data);
    }

    public function editEvent(Event $event)
    {
        $data = array(
            $event->startTime
            , $event->endTime
            , $event->idEmployee
            , $event->idRoom
            , $event->specifics
            , $event->id
        );

        $sql = "UPDATE `events` SET `start_time`=? `end_time`=?, `id_employee`=?, `id_room`=?, `specifics`=?
                WHERE `id`=? ";
        $this->db->queryFetch($sql, $data);
    }

    public function getAllEvents()
    {
        $events = array();
        $sql = "SELECT `id`,`start_time`, `end_time`, `id_employee`, `id_room`, `specifics` FROM `events`";
        $result = $this->db->queryFetchAll($sql);
        if ($result){
            foreach ($result as $res)
            {
                $event = array();
                $event['id'] = $res['id'];
                $event['startTime'] = date('H:i', $res['start_time']);
                $event['endTime'] = date('H:i', $res['end_time']);
                $event['idEmployee'] = $res['user_id'];
                $event['idRoom'] = $res['room_id'];
                $event['specifics'] = $res['specifics'];
                $events[] = $event;
            }
            return $events;
        }
    }

    public function checkEventInterval($startTime, $endTime, $roomId)
    {
        $data = array($roomId, $startTime, $endTime, $startTime, $endTime, $startTime, $endTime);
        $sql = "SELECT `start_time`, `end_time`, `room_id` 
                FROM `booker_events`
                WHERE `room_id` = ?
                AND ? BETWEEN `start_time` and `end_time`
                or ? BETWEEN `start_time` and `end_time`
                or `start_time` BETWEEN ? and ?
                or `end_time` BETWEEN ? and ? ";

        $evIntervals = array();

        if ($result){
            foreach ($result as $res)
            {
                $evIntervals[$res['start_time']] = $res['end_time'];
            }

            return $evIntervals;
        } else {
            return FALSE;
        }
    }

    public function getEventsByDate($date, $nextDate, $roomId)
    {
        $events = array();
        $data = array($date, $nextDate, $roomId);
        $sql = "SELECT `id`,`start_time`, `end_time`, `user_id`, `room_id`, `specifics` 
                FROM `events`
                WHERE `end_time` BETWEEN ? and ?
                AND `room_id` = ?
                ORDER BY `start_time`";

        $result = $this->db-queryFetchAll($sql, $data);

        if ($result){
            foreach ($result as $res)
            {
                $event = array();
                $event['id'] = $res['id'];
                $event['startTime'] = date('H:i', $res['start_time']);
                $event['endTime'] = date('H:i', $res['end_time']);
                $event['idEmployee'] = $res['user_id'];
                $event['idRoom'] = $res['room_id'];
                $event['specifics'] = $res['specifics'];
                $events[] = $event;
            }

            return $events;
        }
    }
}