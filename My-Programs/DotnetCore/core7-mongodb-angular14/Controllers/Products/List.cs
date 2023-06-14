using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Options;

namespace core7_mongodb_angular14.Controllers.Products
{
    [ApiController]
    [Route("[controller]")]
    public class List : ControllerBase {

        private readonly IProductService _productService;
        private readonly ILogger<List> _logger;
        private readonly IConfiguration _configuration;  

        public List(
            IConfiguration configuration,
            IProductService productService,
            ILogger<List> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _productService = productService;
                _logger = logger;            
        }    

        [HttpGet("/listproducts/{page}")]
        public IActionResult ListProducts(int page) {
            try {                
                int totalpage = _productService.TotPage();
                var products = _productService.ListAll(page);
                if (products != null) {
                    return Ok(new {totpage = totalpage, page = page, products = products});
                } else {
                    return Ok(new {statuscode=404, message="No Data found."});
                }
            } catch(AppException ex) {
               return Ok(new {statuscode = 404, Message = ex.Message});
            }
        }


    }        
}