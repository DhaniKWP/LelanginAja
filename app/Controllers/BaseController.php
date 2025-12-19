<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Database;

/**
 * Class BaseController
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Helpers yang auto load
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Database connection
     *
     * @var \CodeIgniter\Database\BaseConnection
     */
    protected $db;

    /**
     * Constructor Controller
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        // WAJIB
        parent::initController($request, $response, $logger);

        // 🔥 INIT DATABASE (INI YANG SEBELUMNYA HILANG)
        $this->db = Database::connect();

        // Contoh kalau mau pakai session:
        // $this->session = service('session');
    }
}
