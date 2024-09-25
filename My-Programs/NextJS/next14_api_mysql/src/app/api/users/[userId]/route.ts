import pool from "@/app/libs/mysql";
import { NextRequest, NextResponse } from "next/server";
import { headers } from "next/headers";
import jwt from 'jsonwebtoken';
import getConfig from 'next/config'

export async function GET(req: NextRequest, context: any) {
    const { params } = context;
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
        const db = await pool.getConnection()
        const [rows] = await db.query('SELECT * FROM account WHERE id = ?',params.userId);
        db.release()
        if (rows[0]) {
            return NextResponse.json({
                status: 200,
                message: `User Id ${params.userId} has been retrieved.`,
                rows            
            });    
        } else {
            return NextResponse.json({
                status: 400,
                message: `User Id does not exists.`            
            });    
        }
    
    } catch (error: any) {
        return NextResponse.json({
            error: error.message
        }, { status: 500})
    }
}

export async function PATCH(req: NextRequest, ctx: any) {
    const data = await req.json();
    const {params} = ctx;

    try {
        const db = await pool.getConnection()
        const [rows] = await db.query('UPDATE account SET isadmin = ? WHERE id = ?', [data.isadmin, params.userId]);
        db.release()
        if (rows[0]) {
            return NextResponse.json({
                status: 200,
                message: "User has been updated.",
                rows
            });    
        } else {
            return NextResponse.json({
                status: 400,
                message: "User ID does not exists."
            });    
        }
    
    } catch (error) {
        return NextResponse.json({
            error: error
        }, { status: 500})
    }

}


export async function DELETE(req: NextRequest, ctx: any) {
    const {params} = ctx;
    let msg: any =  "User ID # " + params.userId.toString() + " has been delete.";

    try {
        const db = await pool.getConnection()
        const [rows] = await db.query('DELETE FROM account WHERE id = ?', [params.userId]);
        db.release()
        if (rows[0]) {
            return NextResponse.json({
                status: 200,
                message: msg,
                rows  
            });

        } else {
            return NextResponse.json({
                status: 400,
                message: "User id does not exists."
            });
        };
    
        
    
    } catch (error: any) {
        return NextResponse.json({
            error: error.message
        }, { status: 500})
    }

}


