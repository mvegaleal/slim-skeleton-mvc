<?php
use \Interop\Container\ContainerInterface as ContainerInterface;

class TicketController {

    protected $ci;

    //Constructor
    public function __construct(ContainerInterface $ci) {
        $this->ci = $ci;
        $this->logger = $ci->logger;
        $this->db = $ci->db;
        $this->renderer = $ci->renderer;
        $this->router = $ci->router;
    }

    public function getTickets($request, $response, $args) {
        $this->logger->addInfo("Ticket list");
        $mapper = new TicketMapper($this->db);
        $tickets = $mapper->getTickets();

        $response = $this->renderer->render($response, "tickets.phtml", ["tickets" => $tickets, "router" => $this->router]);
        return $response;
    }

    public function getTicketNew($request, $response, $args) {
        $component_mapper = new ComponentMapper($this->db);
        $components = $component_mapper->getComponents();
        $response = $this->renderer->render($response, "ticketadd.phtml", ["components" => $components]);
        return $response;
    }

    public function postTicketNew($request, $response, $args) {
        $data = $request->getParsedBody();
        $ticket_data = [];
        $ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
        $ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);

        // work out the component
        $component_id = (int) $data['component'];
        $component_mapper = new ComponentMapper($this->db);
        $component = $component_mapper->getComponentById($component_id);
        $ticket_data['component'] = $component->getName();

        $ticket = new TicketEntity($ticket_data);
        $ticket_mapper = new TicketMapper($this->db);
        $ticket_mapper->save($ticket);

        $response = $response->withRedirect("/tickets");
        return $response;
    }

    public function getTicketId($request, $response, $args) {
        $ticket_id = (int) $args['id'];
        $mapper = new TicketMapper($this->db);
        $ticket = $mapper->getTicketById($ticket_id);

        $response = $this->renderer->render($response, "ticketdetail.phtml", ["ticket" => $ticket]);
        return $response;
    }

}
