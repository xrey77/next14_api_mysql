import { PrismaClient } from "@prisma/client";

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const query = getQuery(event);
    try {

        const product = await prisma.product.findMany({
            where: {
                descriptions: {
                    contains: query.search
                },
            }
        })
        if (product.length === 0) {
            return {statuscode: 404, message: "Product Description not found."};
        }
        return {statuscode: 200, message: 'Product has been retrieved.', product: product};
        
    } catch(e: any) {
        return {statuscode: 404, message: e.message};
    }    
});