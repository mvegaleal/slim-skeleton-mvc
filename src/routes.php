<?php
// Routes

$app->get('default/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/tickets', 'TicketController:getTickets');
$app->get('/ticket/new', 'TicketController:getTicketNew'); 
$app->post('/ticket/new', 'TicketController:postTicketNew');
$app->get('/ticket/{id}', 'TicketController:getTicketId')->setName('ticket-detail');
        
        /*
$app->get('/tickets', function ($request, $response, $args) {
    $this->logger->addInfo("Ticket list");
    $mapper = new TicketMapper($this->db);
    $tickets = $mapper->getTickets();

    $response = $this->renderer->render($response, "tickets.phtml", ["tickets" => $tickets, "router" => $this->router]);
    return $response;
});

$app->get('/ticket/new', function ($request, $response, $args) {
    $component_mapper = new ComponentMapper($this->db);
    $components = $component_mapper->getComponents();
    $response = $this->renderer->render($response, "ticketadd.phtml", ["components" => $components]);
    return $response;
});

$app->post('/ticket/new', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $ticket_data = [];
    $ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);

    // work out the component
    $component_id = (int)$data['component'];
    $component_mapper = new ComponentMapper($this->db);
    $component = $component_mapper->getComponentById($component_id);
    $ticket_data['component'] = $component->getName();

    $ticket = new TicketEntity($ticket_data);
    $ticket_mapper = new TicketMapper($this->db);
    $ticket_mapper->save($ticket);

    $response = $response->withRedirect("/tickets");
    return $response;
});

$app->get('/ticket/{id}', function ($request, $response, $args) {
    $ticket_id = (int)$args['id'];
    $mapper = new TicketMapper($this->db);
    $ticket = $mapper->getTicketById($ticket_id);

    $response = $this->renderer->render($response, "ticketdetail.phtml", ["ticket" => $ticket]);
    return $response;
})->setName('ticket-detail');

*/