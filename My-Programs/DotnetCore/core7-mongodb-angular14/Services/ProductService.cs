using core7_mongodb_angular14.Entities;
using core7_mongodb_angular14.Helpers;
using Microsoft.Extensions.Options;
using MongoDB.Driver;

namespace core7_mongodb_angular14.Services
{
    public interface IProductService {
        Task<Product> CreateProduct(Product product);        
        Boolean UpdateProduct(Product product);
        Boolean UpdateProductPicture(string id, string file);

        IEnumerable<Product> ListAll(int page);
        IEnumerable<Product> SearchAll(string key);
        IEnumerable<Product> Dataset();

        int TotPage();
    }

    public class ProductService : IProductService
    {
        private readonly MongoDBContext _context;
        private readonly AppSettings _appSettings;
        public ProductService(
            MongoDBContext context, 
            IOptions<AppSettings> appSettings
            ) {
            _context = context;
            _appSettings = appSettings.Value;            
        }

        public Task<Product> CreateProduct(Product product)
        {
            FilterDefinition<Product> filterDesc = Builders<Product>.Filter.Eq("Descriptions", product.Descriptions);
            List<Product> desc = _context.Products.Find(filterDesc).ToList();
            if (desc.Count > 0) {
                throw new AppException("Product Description is already taken...");
            }
             _context.Products.InsertOne(product);
            return null;
        }
        public bool UpdateProduct(Product product)
        {
            throw new NotImplementedException();
        }

        public IEnumerable<Product> Dataset()
        {
            var products = _context.Products.Find(_ => true).ToList();
            return products;
        }
        public bool UpdateProductPicture(string id, string file)
        {
            throw new NotImplementedException();
        }

        public IEnumerable<Product> ListAll(int page)
        {
            var perpage = 5;
            var offset = (page -1) * perpage;

            var products = _context.Products.Find(_ => true)
            .SortBy(b => b.Id)
            .Skip(offset)
            .Limit(perpage)
            .ToList();
            return products;
        }

        public IEnumerable<Product> SearchAll(string key)
        {
            FilterDefinition<Product> filterDesc = Builders<Product>.Filter.Regex("Descriptions", "/.*" + key + ".*/i");
            List<Product> prods = _context.Products.Find(filterDesc).ToList();
            return prods;
        }

        public int TotPage()
        {
            var perpage = 5;
            List<Product> totrecs = _context.Products.Find(_ => true).ToList();           
            int totpage = (int)Math.Ceiling((float)(totrecs.Count()) / perpage);
            return totpage;
        }

    }

}