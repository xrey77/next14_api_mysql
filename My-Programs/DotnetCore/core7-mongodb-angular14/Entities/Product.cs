using System.ComponentModel.DataAnnotations.Schema;
using MongoDB.Bson.Serialization.Attributes;
using MongoDB.Bson;

namespace core7_mongodb_angular14.Entities
{
    public class Product {

        [BsonId]
        [BsonRepresentation(BsonType.ObjectId)]
        public string Id { get; set; }

        [BsonElement("descriptions")]
        public string Descriptions { get; set; }

        [BsonElement("qty")]
        public int Qty { get; set; }

        [BsonElement("unit")]
        public string Unit { get; set; }

        [BsonElement("cost_price")]
        public decimal Cost_price { get; set; }

        [BsonElement("sell_price")]
        public decimal Sell_price { get; set; }

        [BsonElement("prod_pic")]
        public string Prod_pic { get; set; }

        [BsonElement("category")]
        public string Category { get; set; }

        [BsonElement("sale_price")]
        public decimal Sale_price { get; set; }

        [BsonElement("alert_level")]
        public int Alert_level { get; set; }

        [BsonElement("critical_level")]
         public int Critical_level { get; set; }

        [BsonElement("date_created")]
         public DateTime Date_created { get; set; } = DateTime.Now;

        [BsonElement("date_updated")]
         public DateTime Date_updated { get; set; }        
    }    
    
}