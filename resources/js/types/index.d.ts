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

export interface Teach {
    id: number;
    teacher_id: number;
    subject_id: number;
    teacher: Teacher;
    subject: Subject;
}

export interface Subject {
    id: number;
    name: string;
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
        total: number;
        from: number;
        to: number;
        search: string | null;
        Teacher: Teacher | null;
    };
    teaches: {
        data: Teach[];
        links: PaginationLink[];
        total: number;
        from: number;
        to: number;
        search: string | null;
    };
    students: {
        data: Student[];
        links: PaginationLink[];
        total: number;
        from: number;
        to: number;
        search: string | null;
    };
    subjects:
        | {
              data: Subject[];
              links: PaginationLink[];
              total: number;
              from: number;
              to: number;
              search: string | null;
          }
        | any;
    search: string | null;
    teacher: Teacher;
    teach: Teach;
    student: Student;
    subject: Subject;
    teacher_id: number;
    flash: {
        message: string | null;
        success: string | null;
        info: string | null;
        warning: string | null;
        error: string | null;
    };
};
