using core7_mongodb_angular14.Controllers.Models;
using core7_mongodb_angular14.Entities;
using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Options;

namespace core7_mongodb_angular14.Controllers.Products
{
    [ApiController]
    [Route("[controller]")]
    public class Add : ControllerBase {

        private readonly IProductService _productService;
        private readonly ILogger<Add> _logger;
        private readonly IConfiguration _configuration;  

        public Add(
            IConfiguration configuration,
            IProductService productService,
            ILogger<Add> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _productService = productService;
                _logger = logger;            
        }    

        [HttpPost("/addproduct")]
        public IActionResult addProduct([FromBody]ProductModel model)
        {
            try 
            {
                Product prod = new Product();
                prod.Descriptions = model.Descriptions;
                prod.Qty = model.Qty;
                prod.Unit = model.Unit;
                prod.Cost_price = model.Cost_price;
                prod.Sale_price = model.Sell_price;
                prod.Prod_pic = null;
                prod.Category = model.Category;
                prod.Sale_price = model.Sale_price;
                prod.Alert_level = model.Alert_level;
                prod.Critical_level = model.Critical_level;
                _productService.CreateProduct(prod);
                return Ok(new {statuscode = 200, message = "New Product added successfully."});
            }
            catch (AppException ex)
            {
                return Ok(new { statuscode = 404, message = ex.Message });
            }
        }
    }
}