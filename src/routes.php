<?php

// Routes
$app->get('/tickets', 'TicketController:getTickets');
$app->get('/ticket/new', 'TicketController:getTicketNew'); 
$app->post('/ticket/new', 'TicketController:postTicketNew');
$app->get('/ticket/{id}', 'TicketController:getTicketId')->setName('ticket-detail');