using MongoDB.Driver;
using MongoDB.Driver.Linq;

namespace core7_mongodb_angular14.Entities
{
    public class MongoDBContext
    {
        private readonly IMongoDatabase _database;

        public MongoDBContext(string connectionString, string databaseName)
        {
            MongoClientSettings settings = new MongoClientSettings();
            var client = new MongoClient(connectionString);
            settings.LinqProvider = LinqProvider.V3;
            client.Settings.Equals(settings);
            _database = client.GetDatabase(databaseName);
        }

        public IMongoCollection<User> Users => _database.GetCollection<User>("Users");
        public IMongoCollection<Product> Products => _database.GetCollection<Product>("Products");

    }    
}