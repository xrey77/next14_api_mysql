import pool from "@/app/libs/mysql";
import { NextRequest, NextResponse } from "next/server";
import { headers } from "next/headers";
import jwt from 'jsonwebtoken';
import getConfig from 'next/config'

export async function PATCH(req: NextRequest, ctx: any) {
    const data = await req.json();
    const {params} = ctx;

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


    try {
        let uid = parseInt(params.idNo,10);
        const db = await pool.getConnection()
        await db.query('UPDATE account SET firstname = ?, lastname = ?, mobileno = ? WHERE id = ?', [data.firstname, data.lastname, data.mobileno, uid]);
        db.release()
            return NextResponse.json({
                status: 200,
                message: "User account has been updated."
            });    
    
    } catch (error) {
        return NextResponse.json({
            error: error
        }, { status: 500})
    }

}