import { NextResponse, NextRequest } from "next/server";
import pool from "@/app/libs/mysql";
import { headers } from "next/headers";
import jwt from 'jsonwebtoken';
import getConfig from 'next/config'

export async function GET(req: NextRequest ,ctx: any) {
    const {params} = ctx
    const { serverRuntimeConfig } = getConfig()   
    let secret: any = serverRuntimeConfig.secret
    
    const headersList = headers();
    let token: any = headersList.get("authorization")?.split(' ')[1];

    try {
        jwt.verify(token, secret);
      } catch(err: any) {
        return NextResponse.json({
            status: 500,
            message: err.message,
        });

      }

    let perpage: any = 5;
    let page: any = parseInt(params.pageNo,10)
    let offset: any = (page -1) * perpage;

    try {
        const db = await pool.getConnection()

        const [totalrows] = await db.query('SELECT count(*) as totalrows FROM account');
        db.release()
        let totrecs: any = totalrows[0].totalrows
        let totpage: any = Math.ceil(totrecs / perpage);

        const [rows] = await db.query('SELECT * FROM account ORDER BY id LIMIT ? OFFSET ?',[perpage, offset]);
        db.release()
        
        return NextResponse.json({
            status: 200,
            message: "New products has been added.",
            totalpage: totpage, page: page,totalrecs: totrecs,
            rows
        });
    
    } catch (error) {
        return NextResponse.json({
            error: error
        }, { status: 500})
    }

}
