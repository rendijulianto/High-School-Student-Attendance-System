export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Grade {
    id: number;
    level: string;
    major: string;
    class: string;
    school_year: string;
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
    teachers: Teacher[] | null;
}

export interface GradeStudent {
    id: number;
    grade_id: number;
    student_id: number;
    grade: Grade;
    student: Student;
}

export interface Schedule {
    id: number;
    grade_id: number;
    teach_id: number;
    grade: Grade;
    teach: Teach;
}

export interface Presence {
    id: number;
    schedule_id: number;
    date: string;
    material: string;
    grade: Grade;
    teach: Teach;
}

export interface PrecenseDetail {
    id: number;
    presence_id: number;
    student_id: number;
    status: string;
    is_approved: boolean;
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
    students:
        | {
              data: Student[];
              links: PaginationLink[];
              total: number;
              from: number;
              to: number;
              search: string | null;
          }
        | any;
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
    grades:
        | {
              data: Grade[];
              links: PaginationLink[];
              total: number;
              from: number;
              to: number;
              search: string | null;
          }
        | any;
    gradeStudents:
        | {
              data: GradeStudent[];
              links: PaginationLink[];
              total: number;
              from: number;
              to: number;
              search: string | null;
          }
        | any;
    schedules: {
        data: Schedule[];
        links: PaginationLink[];
        total: number;
        from: number;
        to: number;
        search: string | null;
    };
    presences: {
        data: Presence[];
        links: PaginationLink[];
        total: number;
        from: number;
        to: number;
        search: string | null;
    };
    presenceDetails: {
        data: PrecenseDetail[];
        links: PaginationLink[];
        total: number;
        from: number;
        to: number;
        search: string | null;
    };

    search: string | null;
    teacher: Teacher;
    teach: Teach;
    student: Student;
    subject: Subject;
    grade: Grade;
    gradeStudent: GradeStudent;
    schedule: Schedule;
    presence: Presence;
    presenceDetail: PrecenseDetail;
    teacher_id: number;
    subject_id: number;
    grade_id: number;
    student_id: number;
    schedule_id: number;
    total_teacher: number;
    total_teach: number;
    total_student: number;
    total_subject: number;
    total_grade: number;
    flash: {
        message: string | null;
        success: string | null;
        info: string | null;
        warning: string | null;
        error: string | null;
    };
};
