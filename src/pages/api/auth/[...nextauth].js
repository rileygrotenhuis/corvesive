import NextAuth from 'next-auth/next';
import GoogleProvider from 'next-auth/providers/google';
import { PrismaAdapter } from '@next-auth/prisma-adapter';
import prisma from '@/config/prisma';

export const authOptions = {
  secret: process.env.AUTH_SECRET,
  providers: [
    GoogleProvider({
      clientId: process.env.GOOGLE_CLIENT_ID,
      clientSecret: process.env.GOOGLE_CLIENT_SECRET,
    }),
  ],
  jwt: {
    signingKey: process.env.AUTH_SECRET,
  },
  database: process.env.DATABASE_URL,
  adapter: PrismaAdapter(prisma),
  callbacks: {
    session({ session, user }) {
      if (session.user) {
        session.user.id = user.id;
        session.user.dailyAllowance = user.dailyAllowance;
        session.user.currentBalance = user.currentBalance;
        session.user.totalBalance = user.totalBalance;
      }

      return session;
    },
  },
};

export default NextAuth(authOptions);
