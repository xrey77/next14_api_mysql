using MongoDB.Bson;
using MongoDB.Bson.Serialization.Attributes;
using MongoDbGenericRepository.Attributes;

namespace core7_mongodb_angular14.Entities
{     
    [CollectionName("Users")]
    public class User {

        [BsonId]
        [BsonRepresentation(BsonType.ObjectId)]
        public String Id { get; set; }        
        
        [BsonElement("Lastname")]
        public String Lastname { get; set; }

        [BsonElement("Firstname")]
        public String Firstname { get; set; }

        [BsonElement("Email")]
        public String Email { get; set; }

        [BsonElement("Mobile")]
        public String Mobile { get; set; }

        [BsonElement("Username")]
        public String Username { get; set; }

        [BsonElement("Password")]
        public String Password { get; set; }

        [BsonElement("Roles")]
         public String Roles { get; set; }

        [BsonElement("Isactivated")]
        public Int32 Isactivated { get; set; }

        [BsonElement("Isblocked")]
        public Int32 Isblocked { get; set; }

        [BsonElement("Profilepic")]
         public String Profilepic { get; set; }

        [BsonElement("Qrcodeurl")]
        public String Qrcodeurl { get; set; }

        [BsonElement("Mailtoken")]
        public Int32 Mailtoken { get; set; }

        [BsonElement("Secretkey")]
        public String Secretkey { get; set; }

        [BsonElement("date_created")]
        public DateTime Date_created { get; set; } = DateTime.Now;

        [BsonElement("date_updated")]
        public DateTime Date_updated { get; set; }
    }    
}