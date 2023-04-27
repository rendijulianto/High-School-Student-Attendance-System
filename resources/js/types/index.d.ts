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

export interface Student {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    nis: string;
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

interface PaginationMeta {
    perPage: number;
    lastPage: number;
    currentPage: number;
    total: number;
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
        total: number;
        from: number;
        to: number;
        search: string | null;
        pagination: PaginationMeta;
    };
    students: {
        data: Student[];
        links: PaginationLink[];
        total: number;
        from: number;
        to: number;
        search: string | null;
        pagination: PaginationMeta;
    };

    posts: {
        data: Post[];
        links: PaginationLink[];
        search: string | null;
    };
    search: string | null;
    post: Post;
    teacher: Teacher;
    student: Student;
    flash: {
        message: string | null;
        success: string | null;
        info: string | null;
        warning: string | null;
        error: string | null;
    };
    perPage: number;
    lastPage: number;
    currentPage: number;
    totalData: number;
    params: any;
    links: PaginationLink[];
};
