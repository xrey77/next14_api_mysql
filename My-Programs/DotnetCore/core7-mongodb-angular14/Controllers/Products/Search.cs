using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Models;
using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Options;

namespace core7_mongodb_angular14.Controllers.Products
{
    [ApiController]
    [Route("[controller]")]
    public class Search : ControllerBase {
        private readonly IProductService _productService;
        private readonly ILogger<Search> _logger;
        private readonly IConfiguration _configuration;  

        public Search(
            IConfiguration configuration,
            IProductService productService,
            ILogger<Search> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _productService = productService;
                _logger = logger;            
        }    
    
        [HttpPost("/searchproducts")]
        public IActionResult SearchProducts([FromBody]ProductSearch prod) {
            try {                
                var products = _productService.SearchAll(prod.Search);
                if (products is not null) {
                    return Ok(new {products=products});
                } else {
                    return Ok(new {statuscode=404, message="No Data found."});
                }
            } catch(AppException ex) {
               return Ok(new {statuscode = 404, Message = ex.Message});
            }
        }


    }
}