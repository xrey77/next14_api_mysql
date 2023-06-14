using core7_mongodb_angular14.Controllers.Models;
using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Models;
using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Options;

namespace core7_mongodb_angular14.Controllers.Products
{
    [ApiController]
    [Route("[controller]")]
    public class Update : ControllerBase {

        private readonly IProductService _productService;
        private readonly ILogger<Update> _logger;
        private readonly IConfiguration _configuration;  

        public Update(
            IConfiguration configuration,
            IProductService productService,
            ILogger<Update> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _productService = productService;
                _logger = logger;            
        }    

        [HttpPut("/updateproduct/{id}")]
        public IActionResult UpdateProduct(string id, ProductModel model)
        {

            return Ok(new {statuscode = 200, message ="ok"});
        }

    }
}