<php?
namespace App\Controllers;

use CodeIgniter\Controller;

class KapusController extends Controller
{
    public function index()
    {
        return view('kapus/dashboard');
    }
}