export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Teacher {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    nip: string;
    gender: string;
}

export interface Post {
    id: number;
    title: string;
    description: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    teachers: {
        data: Teacher[];
        links: PaginationLink[];
        search: string | null;
    };
    posts: {
        data: Post[];
        links: PaginationLink[];
        search: string | null;
    };
    search: string | null;
    post: Post;
    totalData: number | null;
};
