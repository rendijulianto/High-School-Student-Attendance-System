import AuthenticatedLayoutTeacher from "@/Layouts/AuthenticatedLayoutTeacher";
import { PageProps } from "@/types";
import { Head, Link } from "@inertiajs/react";
import {
    FaArrowCircleRight,
    FaChalkboardTeacher,
    FaGraduationCap,
    FaObjectGroup,
} from "react-icons/fa";

export default function DashboardTeacherTeacher({
    auth,
    total_student,
    total_teacher,
    total_grade,
}: PageProps) {
    return (
        <AuthenticatedLayoutTeacher
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    DashboardTeacher
                </h2>
            }
        >
            <Head title="DashboardTeacher" />

            <div className="py-12">
                {/* grid jika default 12 jika md 6 jika lg 4 */}

                <div className="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="p-6 text-gray-900 dark:text-gray-100">
                        <div className="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <FaObjectGroup className="w-10 h-10 mb-2 text-gray-500 dark:text-gray-400" />
                            <a href="#">
                                <h5 className="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    Total Kelas
                                </h5>
                            </a>
                            <p className="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                Total Kelas yang tersedia{" "}
                                {new Intl.NumberFormat().format(total_grade)}{" "}
                                Kelas
                            </p>
                            <Link
                                href={route("grades.index")}
                                className="inline-flex items-center text-blue-600 hover:underline"
                            >
                                Selengkapnya ...
                                <FaArrowCircleRight className="w-5 h-5 ml-2" />
                            </Link>
                        </div>
                    </div>
                    <div className="p-6 text-gray-900 dark:text-gray-100">
                        <div className="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <FaChalkboardTeacher className="w-10 h-10 mb-2 text-gray-500 dark:text-gray-400" />
                            <a href="#">
                                <h5 className="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    Total Guru
                                </h5>
                            </a>
                            <p className="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                Total Guru yang tersedia{" "}
                                {new Intl.NumberFormat().format(total_teacher)}{" "}
                                Guru
                            </p>
                            <Link
                                href={route("teachers.index")}
                                className="inline-flex items-center text-blue-600 hover:underline"
                            >
                                Selengkapnya ...
                                <FaArrowCircleRight className="w-5 h-5 ml-2" />
                            </Link>
                        </div>
                    </div>
                    <div className="p-6 text-gray-900 dark:text-gray-100">
                        <div className="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <FaGraduationCap className="w-10 h-10 mb-2 text-gray-500 dark:text-gray-400" />
                            <a href="#">
                                <h5 className="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    Total Siswa
                                </h5>
                            </a>
                            <p className="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                Total Siswa yang tersedia{" "}
                                {new Intl.NumberFormat().format(total_student)}{" "}
                                Siswa
                            </p>
                            <Link
                                href={route("students.index")}
                                className="inline-flex items-center text-blue-600 hover:underline"
                            >
                                Selengkapnya ...
                                <FaArrowCircleRight className="w-5 h-5 ml-2" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayoutTeacher>
    );
}
